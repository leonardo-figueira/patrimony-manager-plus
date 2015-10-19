<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Services as PMPService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/relatorio")
 */
class RelatorioController extends Controller
{
    /**
     * @Route("/patrimonio-situacao", name="relatorioQuantitativoContaPatrimonial")
     * @Template()
     */
    public function patrimonioPorSituacaoAction()
    {

        $servicePatrimonio = $this->get('pmp.patrimonio_busca');
        $servicePatrimonio->patrimonioPorSituacao();

        var_dump($servicePatrimonio);
        exit;

        return array('contasPatrimoniais' => $contasPatrimoniais);
    }

    /**
     * @Route("/salvar", name="contaPatrimonial_salvar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function salvarAction(Request $request)
    {

        return $this->redirectToRoute('contaPatrimonial_index');
    }


    /**
     * @Route("/editar", name="contaPatrimonial_editar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editarAction(Request $request)
    {


        return $this->redirectToRoute('contaPatrimonial_index');
    }

}