<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Model\AdminNotification;

class Messages
{
    const MSBASE_SESSION_IDENTIFIER = 'msbase-session-messages';

    /**
     * @var \Magento\Backend\Model\Session
     */
    private $session;

    public function __construct(
        \Magento\Backend\Model\Session $session
    ) {
        $this->session = $session;
    }

    /**
     * @param string $message
     */
    public function addMessage($message)
    {
        $messages = $this->session->getData(self::MSBASE_SESSION_IDENTIFIER);
        if (!$messages || !is_array($messages)) {
            $messages = [];
        }

        $messages[] = $message;
        $this->session->setData(self::MSBASE_SESSION_IDENTIFIER, $messages);
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $messages = $this->session->getData(self::MSBASE_SESSION_IDENTIFIER);
        $this->clear();
        if (!$messages || !is_array($messages)) {
            $messages = [];
        }

        return $messages;
    }

    public function clear()
    {
        $this->session->setData(self::MSBASE_SESSION_IDENTIFIER, []);
    }
}
