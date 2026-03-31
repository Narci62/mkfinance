<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvestmentRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $data)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if($notifiable->account_type == "investor"){

        return (new MailMessage)
                    ->line('Félicitation !!! Vous avez investir dans '. $this->data->project->titled .'.')
                    ->action('Consulter le projet', url('/'))
                    ->line('Merci pour votre confiance!');
        }
        else{
            return (new MailMessage)
                    ->line('Vous avez un nouveau investisseur pour le projet '. $this->data->project->titled .'.')
                    ->action('Espace d\'administration', url('/'))
                    ->line('Merci pour votre confiance!');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $data = [
            'investment_id'=>$this->data->id,
            'project_titled'=>$this->data->project->titled,
            'project_imat'=>$this->data->project->imat,
            'amount'=>$this->data->amount
        ];
        if($notifiable->account_type == "investor"){
            $data['message'] = "Félicitation !!! Vous avez investir dans le projet ". $this->data->project->titled;
            $data['message'] .= "Soumis par ". $this->data->project->company->name . ".";
            $data['url_project'] = url('/project/'. $this->data->project->imat);
        }
        if($notifiable->acount_type == "company"){
            $data['message'] = "Félicitation !!! Un investisseur vient d'investir dans votre project ". $this->data->project->titled;
            $data['message'] .= "Son identification ". $this->data->investor->matricule . ".";
        }

        return [
            $data
        ];
    }
}
