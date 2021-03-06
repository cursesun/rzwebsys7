<?php
namespace common\db\fields;

use common\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class HasOneField
 * Поле для связей Has One. Интерфейс привязки в форме в виде выпадающего списка.
 * @package common\db\fields
 * @author Churkin Anton <webadmin87@gmail.com>
 */
class HasOneField extends ListField
{

    /**
     * @var string имя связи
     */
    public $relation;

    /**
     * @var string имя атрибута связанной модели отображаемого в гриде
     */
    public $gridAttr = "title";

    /**
     * @inheritdoc
     */
    public $numeric = true;

    /**
     * Конструктор
     * @param ActiveRecord $model модель
     * @param string $attr атрибут
     * @param string $relation имя Has One связи
     */
    public function __construct(ActiveRecord $model, $attr, $relation, $config = [])
    {

        $this->relation = $relation;

        parent::__construct($model, $attr, $config);

    }

    /**
     * @inheritdoc
     */
    protected function grid()
    {

        $grid = $this->defaultGrid();

        $grid["value"] = function ($model, $index, $widget) {

            return ArrayHelper::getValue($model, "{$this->relation}.{$this->gridAttr}");

        };

        return $grid;

    }

    /**
     * @inheritdoc
     */
    protected function view()
    {

        $view = $this->defaultView();

        $view["value"] = ArrayHelper::getValue($this->model, "{$this->relation}.{$this->gridAttr}");

        return $view;

    }

}