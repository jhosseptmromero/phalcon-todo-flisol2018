<?php

class TodosController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->sendJson(Todo::find()->toArray());
    }

    public function saveAction()
    {
        $body = $this->request->getJsonRawBody(true);
        $todo = new Todo();
        $todo->save($body);
        $this->sendJson($todo->toArray());
    }

    public function editAction()
    {
        $body = $this->request->getJsonRawBody();
        $todo = Todo::findFirst($body->id);
        $todo->setTitle($body->title);
        $todo->setCompleted($body->completed == true ? 1 : 0);
        $todo->update();
        $this->sendJson($todo->toArray());

    }

    public function removeAction($id)
    {
        Todo::findFirst($id)->delete();
    }

    public function sendJson($body)
    {
        $this->view->disable();
        $this->response->setJsonContent($body);
        $this->response->send();
    }


}

