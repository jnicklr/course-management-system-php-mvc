<?php

namespace Framework;

class Controller
{
    protected Request $request;
    protected Response $response;
    protected TemplateViewer $viewer;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function setViewer(TemplateViewer $viewer): void
    {
        $this->viewer = $viewer;
    }

    protected function view(string $template, array $data = []): Response
    {
        $this->response->setBody($this->viewer->render($template, $data));

        return $this->response;        
    }

    protected function json(array $data = []): Response
    {
        $json = json_encode($data);
        $this->response->setBody($json);

        return $this->response;        
    }

    protected function redirect(string $url): Response
    {
        $this->response->redirect($url);

        return $this->response;
    }

}