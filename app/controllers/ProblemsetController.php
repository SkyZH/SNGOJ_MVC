<?php

class ProblemsetController extends ControllerBase {
    public function initialize() {
        $this->tag->setTitle('Problems');
        parent::initialize();
    }

    public function indexAction() {
        $problems = Problemset::find();
        $this->view->problems = $problems;
    }

    public function newAction() {
        $form = new ProblemForm();
        $this->view->form = $form;
    }

    public function editAction($pid) {
        if (!$this->request->isPost()) {
            $problem = Problemset::findFirst(array(
                "pid = :pid:", 'bind' => array('pid' => $pid)));
            if (!$problem) {
                $this->flash->error("Problem was not found");
                return $this->forward("problemset/index");
            }
            $this->view->problem = $problem;
            $this->view->form = new ProblemForm($problem, array('edit' => true));
        }
    }
    public function saveAction($pid)
    {
        if (!$this->request->isPost()) {
            return $this->forward("problemset/index");
        }

        if($pid != "0")
        {
            $problem = Problemset::findFirst(array(
                "pid = :pid:", 'bind' => array('pid' => $pid)));

            if (!$problem) {
                $this->flash->error("Problem does not exist");
                return $this->forward("problemset/index");
            }
        }
        else {
            $problem = new Problemset();
        }

        $form = new ProblemForm ;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $problem)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            if($pid == "0") return $this->forward('problemset/new/');
            else return $this->forward('problemset/edit/' . $problem->pid);
        }

        if ($problem->save() == false) {
            foreach ($problem->getMessages() as $message) {
                $this->flash->error($message);
            }
            if($pid == "0") return $this->forward('problemset/new/');
            else return $this->forward('problemset/edit/' . $problem->pid);
        }

        $form->clear();

        $this->flash->success("Problem was updated successfully");
        return $this->forward('problemset/view/' . $problem->pid);
    }

    public function viewAction($pid) {
        $problem = Problemset::findFirst(array(
            "pid = :pid:", 'bind' => array('pid' => $pid)));

        $this->view->problem = $problem;
    }
}
