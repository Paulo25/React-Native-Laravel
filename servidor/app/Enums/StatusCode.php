<?php

namespace App\Enums;

class StatusCode
{
    /**
     * requisição foi feita com sucesso.
     */
    const OK = '200';

    /**
     * requisição foi feita com sucesso e que um recurso foi criado.
     */
    const CREATED = '201';

    /**
     * requisição foi feita com sucesso, porem sem retorno de mensagem no corpo.
     */
    const NO_CONTENT = '204';

    /**
     * Indica que uma requisição não possuí um formato ou dados especifico.
     */
    const BAD_REQUEST = '400';

    /**
     * Indica que o recurso precisa de um requisição autenticada antes de proseguir.
     */
    const UNAUTHORIZED = '401';

    /**
     * Indica que o recurso da requisição não existe.
     */
    const NOT_FOUND = '404';

    /**
     * Indica que o método HTTP utilizado não esta disponível para aquele endpoint.
     */
    const METHOD_NOT_ALLOWED = '405';

    /**
     * Indica que um conflito ocorreu durante a requisição.
     */
    const CONFLICT = '409';

    /**
     * Indica que a request foi realizada e entendida pelo servidor, porem não foi possível proceguir devido a erros no formato/parâmetros informados.
     */
    const UNPROCESSABLE_ENTITY = '422';

    /**
     * Indica uma falha do lado servidor, normalmente utilizamos quando algo inesperado acontece do lado servidor.
     */
    const INTERNAL_SERVER_ERROR = '500';

}
