<?php

class Todo extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(column="title", type="string", nullable=true)
     */
    protected $title;

    /**
     *
     * @var integer
     * @Column(column="completed", type="integer", length=4, nullable=false)
     */
    protected $completed;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field completed
     *
     * @param integer $completed
     * @return $this
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field completed
     *
     * @return integer
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Method to set the value of field complete
     *
     * @param integer $complete
     * @return $this
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;

        return $this;
    }

    /**
     * Returns the value of field complete
     *
     * @return integer
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * Method to set the value of field todoId
     *
     * @param integer $todoId
     * @return $this
     */
    public function setTodoId($todoId)
    {
        $this->todoId = $todoId;

        return $this;
    }

    /**
     * Returns the value of field todoId
     *
     * @return integer
     */
    public function getTodoId()
    {
        return $this->todoId;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("flisol18");
        $this->setSource("todo");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Todo[]|Todo|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Todo|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'todo';
    }

}
