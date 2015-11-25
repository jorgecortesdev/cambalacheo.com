<?php

namespace App\Http;

class Flash
{
    /**
     * Crea un mensaje de sesion.
     *
     * @param  string      $message
     * @param  string      $title
     * @param  string      $level
     * @param  string|null $key
     * @return void
     */
    protected function create($message, $title, $level, $key = 'flash_message')
    {
        session()->flash($key, [
            'title'   => $title,
            'message' => $message,
            'level'   => $level,
        ]);
    }

    /**
     * Crea un mensaje informativo.
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function info($message, $title = null)
    {
        return $this->create($message, $title, 'info');
    }

    /**
     * Crea un mensaje exitoso.
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function success($message, $title = null)
    {
        return $this->create($message, $title, 'success');
    }

    /**
     * Crea un mensaje de error.
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function error($message, $title = null)
    {
        return $this->create($message, $title, 'error');
    }

    /**
     * Crea un mensaje de advertencia.
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function warning($message, $title = null)
    {
        return $this->create($message, $title, 'warning');
    }

    /**
     * Crea un mensaje con confirmacion.
     *
     * @param  string      $message
     * @param  string|null $title
     * @param  string      $level
     * @return void
     */
    public function overlay($message, $title = null, $level = 'info')
    {
        return $this->create($title, $message, $level, 'flash_message_overlay');
    }
}