<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use PMPBundle\Entity as PMPEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/conta-patrimonial")
 */
class PatrimonioController extends Controller
{
    /**
     * @Route("/pmp/conta-patrimonial/novo", name="pmp_contaPatrimonial_novo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function salvarAction(Request $request)
    {
        $manipulador = $this->get('pmp.conta_patrimonial_edicao');

        $entity = new PMPEntity\Patrimonio();
        $entity->setContaPatrimonial($request->request->get('patrimonioContaPatrimonial'));
        $entity->setPlaqueta($request->request->get('patrimoniPlaqueta'));
        $entity->setCentroDeCusto($request->request->get('patrimonioCentroCusto'));
        $entity->setDtaquisicao($request->request->get('patrimonioDtAquisicao'));
        $entity->setNopatrimonio($request->request->get('patrimonioDescicao'));
        $entity->setSituacao($request->request->get('patrimonioSituacao'));
        $entity->setNrnotafiscal($request->request->get('patrimonioNotaFiscal'));

        $manipulador->salvar($entity);

        return $this->redirectToRoute('index');
    }



}