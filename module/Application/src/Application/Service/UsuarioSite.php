<?php

namespace Application\Service;

use Common\AbstractService,
    Application\Entity\Usuario as UsuarioEntity,
    Application\Entity\Site as SiteEntity,
    Application\Entity\UsuarioSite as UsuarioSiteEntity;

class UsuarioSite extends AbstractService
{
    public function relacionar(SiteEntity $site, UsuarioEntity $usuario, $isAdmin = false)
    {

        $us = new UsuarioSiteEntity(
            array(
                'site' => $site,
                'usuario' => $usuario,
                'isAdmin' => $isAdmin
            )
        );

        $this->em->persist($us);

        $usuario->sites->add($us);
        $site->usuarios->add($us);

        $this->em->flush();

        return $us;

    }
}
