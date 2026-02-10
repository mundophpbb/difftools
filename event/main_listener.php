<?php
namespace mundophpbb\difftools\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
    protected $template;
    protected $user; // Adicionado para carregar o idioma

    public function __construct(\phpbb\template\template $template, \phpbb\user $user)
    {
        $this->template = $template;
        $this->user = $user;
    }

    static public function getSubscribedEvents()
    {
        return [
            'core.page_header_after' => 'insert_diff_assets',
        ];
    }

    public function insert_diff_assets($event)
    {
        // Carrega o arquivo de linguagem common.php da nossa extensão
        $this->user->add_lang_ext('mundophpbb/difftools', 'common');

        $this->template->assign_vars([
            'T_DIFF_CSS' => true,
        ]);
    }
}