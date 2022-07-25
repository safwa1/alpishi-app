<?php

namespace App\Http\Livewire;

use App\Models\StaticMessages;
use App\Utils\ArrayList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class StaticMessagesModifier extends Component
{
    public $messageModel;

    public $deletedMessage;

    public $messageIndexBeingDeleted;

    public $messageIndexBeingUpdated = null;

    public bool $confirmingMessageDeletion = false;

    public bool $managingMessages = false;

    public array $messages = [];

    protected $listeners = [
        'message:deleted' => 'messageDeleted',
        'message:updated' => 'messageUpdated',
        'message:created' => 'messageCreated',
    ];

    protected $rules = [
        'messageModel.message' => ['required']
    ];

    protected $validationAttributes = [
        'messageModel.message' => 'message'
    ];

    private function cacheCurrentMessage(): void
    {
        $this->deletedMessage = $this->messages[$this->messageIndexBeingDeleted];
    }

    private function removeCurrentMessage(): void
    {
        unset($this->messages[$this->messageIndexBeingDeleted]);
    }

    private function getCurrentIdForDelete()
    {
        return $this->messages[$this->messageIndexBeingDeleted]['id'];
    }

    private function getCurrentIdForUpdate()
    {
        return $this->messages[$this->messageIndexBeingUpdated]['id'];
    }

    public function managingMessages(int|string|null $index = null): void
    {
        $this->managingMessages = true;
        $this->messageIndexBeingUpdated = $index;
        $this->messageModel = !isset($this->messageIndexBeingUpdated)
            ? $this->defaultModel()
            : $this->messages[$this->messageIndexBeingUpdated];
    }

    public function confirmingMessageDeletion($index): void
    {
        $this->confirmingMessageDeletion = true;
        $this->messageIndexBeingDeleted = $index;
    }

    public function saveMessage(): void
    {
        if (!isset($this->messageIndexBeingUpdated)) {
            $this->createMessage();
            return;
        }
        $this->updateMessage();
    }

    /**
     * @return void
     */
    public function createMessage(): void
    {
        $this->validate();
        $created = StaticMessages::query()->create($this->messageModel);
        $this->messages[] = $created->toArray();
        $this->emit('message:created');
    }

    public function updateMessage()
    {
        $this->validate();
        $message = $this->messageModel ?? NULL;
        if (!is_null($message)) {
            optional(StaticMessages::query()->find($this->getCurrentIdForUpdate()))->update($message);
        }
        $this->emit('message:updated');
    }

    public function deleteMessage(): void
    {
        if (StaticMessages::query()->where('id', $this->getCurrentIdForDelete())->first()->delete()) {
            // hide deletion model
            $this->confirmingMessageDeletion = false;

            // save last removed item (use it in the future to undo delete)
            $this->cacheCurrentMessage();

            // remove deleted message from messages array
            $this->removeCurrentMessage();

            // emit event
            $this->emit('message:deleted');
        }
    }

    public function changeMessageState($index): void
    {
        $message = $this->messages[$index] ?? NULL;
        $message['state'] = $message['state'] == 'on' ? 'off' : 'on';
        if (!is_null($message)) {
            optional(StaticMessages::query()->find($message['id']))->update($message);
        }
        $this->messages[$index] = $message;
    }

    public function messageDeleted(): void
    {
        // re-index messages array after delete element from it
        $this->messages = ArrayList::reIndex($this->messages);

        // show toast message with undo button
        // ...
    }

    public function messageUpdated(): void
    {
        $this->messages[$this->messageIndexBeingUpdated] = $this->messageModel;
        $this->messageIndexBeingUpdated = null;
        $this->messageModel = $this->defaultModel();
        $this->managingMessages = false;
    }


    public function messageCreated(): void
    {
        $this->messageModel = $this->defaultModel();
        $this->managingMessages = false;
    }

    private function loadMessages(): array
    {
        return StaticMessages::all()->toArray();
    }

    public function mount()
    {
        $this->messages = $this->loadMessages();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.static-messages.modifier');
    }

    public function defaultModel(): array
    {
        return [
            'id' => '',
            'message' => '',
            'type' => 'info',
            'state' => 'on',
            'show_at' => null,
            'expires_at' => null,
        ];
    }
}
