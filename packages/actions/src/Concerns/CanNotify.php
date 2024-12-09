<?php

namespace Filament\Actions\Concerns;

use Closure;
use Filament\Notifications\Notification;

trait CanNotify
{
    protected Notification | Closure | null $failureNotification = null;

    protected Notification | Closure | null $successNotification = null;

    protected string | Closure | null $failureNotificationTitle = null;

    protected string | Closure | null $failureNotificationBody = null;

    protected string | Closure | null $successNotificationTitle = null;

    protected string | Closure | null $successNotificationBody = null;

    public function sendFailureNotification(): static
    {
        $notification = $this->evaluate($this->failureNotification, [
            'notification' => Notification::make()
                ->danger()
                ->title($this->getFailureNotificationTitle())
                ->body($this->getFailureNotificationBody()),
        ]);

        if (filled($notification?->getTitle())) {
            $notification->send();
        }

        return $this;
    }

    public function failureNotification(Notification | Closure | null $notification): static
    {
        $this->failureNotification = $notification;

        return $this;
    }

    /**
     * @deprecated Use `failureNotificationTitle()` instead.
     */
    public function failureNotificationMessage(string | Closure | null $message): static
    {
        return $this->failureNotificationTitle($message);
    }

    public function failureNotificationTitle(string | Closure | null $title): static
    {
        $this->failureNotificationTitle = $title;

        return $this;
    }

    public function failureNotificationBody(string | Closure | null $body): static
    {
        $this->failureNotificationBody = $body;

        return $this;
    }

    public function sendSuccessNotification(): static
    {
        $notification = $this->evaluate($this->successNotification, [
            'notification' => Notification::make()
                ->success()
                ->title($this->getSuccessNotificationTitle())
                ->body($this->getSuccessNotificationBody()),
        ]);

        if (filled($notification?->getTitle())) {
            $notification->send();
        }

        return $this;
    }

    public function successNotification(Notification | Closure | null $notification): static
    {
        $this->successNotification = $notification;

        return $this;
    }

    /**
     * @deprecated Use `successNotificationTitle()` instead.
     */
    public function successNotificationMessage(string | Closure | null $message): static
    {
        return $this->successNotificationTitle($message);
    }

    public function successNotificationTitle(string | Closure | null $title): static
    {
        $this->successNotificationTitle = $title;

        return $this;
    }

    public function successNotificationBody(string | Closure | null $body): static
    {
        $this->successNotificationBody = $body;

        return $this;
    }

    public function getSuccessNotificationTitle(): ?string
    {
        return $this->evaluate($this->successNotificationTitle);
    }

    public function getSuccessNotificationBody(): ?string
    {
        return $this->evaluate($this->successNotificationBody);
    }

    public function getFailureNotificationTitle(): ?string
    {
        return $this->evaluate($this->failureNotificationTitle);
    }

    public function getFailureNotificationBody(): ?string
    {
        return $this->evaluate($this->failureNotificationBody);
    }
}
