<?php

namespace app\Model;

use app\Core\Model;

/**
 * Classe responsável por gerenciar a conexão com a tabela Postagem.
 */
class ProdutoModel
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new Model();
    }

    /**
     * Converte uma estrutura de array vinda da base de dados em um objeto
     *
     * $param Recebe o parâmetro que é retornado na consulta com a base de dados
     * @return object Retorna um objeto da estrutura de postagem
     */
    private function organizeData($param)
    {
        return (object)[
            'titulo'   => $param['titulo']   ?? null,
            'conteudo' => $param['conteudo'] ?? null,
        ];
    }

    /**
     * Retorna todos os registros da base de dados em ordem ascendente por nome
     *
     * @return arra[object]
     */
    public function selectAllPosts()
    {
        $sql = 'SELECT id, titulo, conteudo FROM postagem ORDER BY id DESC';

        $dataTable = $this->pdo->executeQuery($sql);

        $listPosts = null;

        foreach ($dataTable as $dataRow) {
            $listPosts[] = $this->organizeData($dataRow);
        }
        return $listPosts;
    }

    /**
     * Retorna um único registro da base de dados através do ID informado
     *
     * @param  int $id ID do objeto a ser retornado
     * @return object Retorna um objeto populado com os dados da postagem ou se não encontrar com seus valores nulos
     */
    public function selectPostsById(int $id)
    {
        $sql = 'SELECT id, titulo, conteudo FROM postagem WHERE id = :id';

        $param = [
            ':id' => $id
        ];

        $dr = $this->pdo->executeQueryOneRow($sql, $param);

        return $this->organizeData($dr);
    }

    /**
     * Insere um novo registro na tabela de postagem e retorna seu ID em caso de sucesso
     *
     * @params  Object $params Lista com os parâmetros a serem inseridos
     * @return int Retorna o ID do produto inserido ou -1 em caso de erro
     */

    public function insertPost(object $params)
    {
        $sql = 'INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)';

        $params = [
            ':titulo' => $params->titulo,
            ':conteudo' => $params->conteudo,
        ];

        if (!$this->pdo->executeNonQuery($sql, $params)) {
            return -1; // Código de Erro
        }
        return $this->pdo->getLastId();
    }

    /**
     * Atualiza um registro na base de dados através do ID da postagem
     *
     * @param  Object $params Lista com os parâmetros a serem inseridos
     */
    public function updatePost(object $params)
    {
        $sql = 'UPDATE postagem SET titulo = :titulo, conteudo = :conteudo WHERE id = :id';

        $params = [
            ':id'       => $params->id,
            ':titulo'   => $params->titulo,
            ':conteudo' => $params->conteudo
        ];

        return $this->pdo->executeNonQuery($sql, $params);
    }
}
