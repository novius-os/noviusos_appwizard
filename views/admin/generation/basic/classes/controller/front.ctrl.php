<?= "<?php\n" ?>

namespace <?= $data['application_settings']['namespace'] ?>;

use Nos\Controller_Front_Application;

use View;

class Controller_Front_<?= $model['name'] ?> extends Controller_Front_Application
{
    public function action_main($args = array())
    {
        $enhancer_url = $this->main_controller->getEnhancerUrl();

        if (!empty($enhancer_url)) {
            $segments = explode('/', $enhancer_url);

            if (!empty($segments[0])) {
                return $this->display_<?= $model['table_name'] ?>($segments[0]);
            }

            throw new \Nos\NotFoundException();
        }

        return $this->display_list_<?= $model['table_name'] ?>();
    }

    protected function display_list_<?= $model['table_name'] ?>()
    {
        $<?= $model['table_name'] ?>_list =  Model_<?= $model['name'] ?>::find('all', array(
            'order_by' => array(
                '<?= $model['column_prefix'] ?>id' => 'ASC'
            ),
            'limit' => 10
        ));

        return \View::forge('front/<?= $model['table_name'] ?>_list', array(
            '<?= $model['table_name'] ?>_list' => $<?= $model['table_name'] ?>_list,
        ));
    }


    protected function display_<?= $model['table_name'] ?>($virtual_name)
    {
        $<?= $model['table_name'] ?> = Model_<?= $model['name'] ?>::find('first', array(
            'where' => array(
                array('<?= $model['column_prefix'] ?>virtual_name', '=', $virtual_name)
            )
        ));

        if (empty($<?= $model['table_name'] ?>)) {
            throw new \Nos\NotFoundException();
        }

        $this->main_controller->setTitle($<?= $model['table_name'] ?>-><?= $model['column_prefix'] ?><?= $model['title_column_name'] ?>);
        //$this->main_controller->setMetaDescription($<?= $model['table_name'] ?>-><?= $model['column_prefix'] ?><?= $model['title_column_name'] ?>);

        return \View::forge('front/<?= $model['table_name'] ?>_item', array(
            '<?= $model['table_name'] ?>' => $<?= $model['table_name'] ?>,
        ));
    }


    public static function get_url_model($item, $params = array())
    {
        // url built according to $item'class
        switch (get_class($item)) {
            case '<?= $data['application_settings']['namespace'] ?>\Model_<?= $model['name'] ?>' :
                return urlencode($item->virtual_name()).'.html';
                break;
        }

        return false;
    }
}