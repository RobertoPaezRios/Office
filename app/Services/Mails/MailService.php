<?php

namespace App\Services\Mails;



class MailService {
  /**
   * Data = [
   *  'to',
   *  'subject',
   *  'cc',
   *  'template',
   *  'data'
   * ]
   */

  public function sendEmail(array $data) {
    try {
      Mail::send($data['template'], $data, function ($message) use ($data) {
        $message->from(env('MAIL_FROM_ADDRESS'), $data['senderName']);
        if (isset($data['cc']) && count($data['cc']) > 0) {
          $message->cc(implode(';', $data['cc']));
        }
        $message->to($data['to']);
        $message->subject($data['subject']);
      });
    } catch (Throwable $e) {
      Log::info('Error en el envio del email'. $e->getMessage());
    }
  }
}