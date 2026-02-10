<?php
namespace mundophpbb\difftools\migrations;

class v100 extends \phpbb\db\migration\migration
{
    static public function depends_on()
    {
        return [];
    }

    public function update_data()
    {
        return [
            ['custom', [[$this, 'add_diff_bbcode']]],
        ];
    }

    public function add_diff_bbcode()
    {
        $sql = 'SELECT bbcode_id FROM ' . BBCODES_TABLE . " WHERE bbcode_tag = 'dif'";
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$row) {
            $sql_ary = [
                'bbcode_tag'          => 'dif',
                // Em vez de texto, usamos a chave de linguagem
                'bbcode_helpline'     => 'MUNDOPHPBB_DIFF_HELPLINE',
                'display_on_posting'  => 1,
                'bbcode_tpl'          => '<div class="gh-diff-box"><div class="gh-diff-header">{L_MUNDOPHPBB_DIFF_TITLE}</div><div class="diff-content">{TEXT}</div></div>',
                'bbcode_show_on_posting' => 1,
            ];

            $this->db->sql_query('INSERT INTO ' . BBCODES_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary));
        }
    }
}