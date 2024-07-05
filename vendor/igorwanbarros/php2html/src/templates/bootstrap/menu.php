<?php

function renderItens($itens)
{
    $li = '';
    foreach ($itens as $item){
        $subNivel = null;
        if (is_array($item)) {
            $subNivel = $item;
            $item = current($item);
            unset($subNivel[0]);
        }

        $isArraySubNivel = is_array($subNivel);

        $pullRight  = $isArraySubNivel ? '<i class="fa fa-angle-left pull-right"></i>' : '';
        $href       = $isArraySubNivel ? '#' : $item->getHref();
        $liClass    = $isArraySubNivel ? 'treeview' : '';

        $li .= '<li class="' . $liClass . '">' .
            '<a href="' . $href . '">' .
                '<i class="' . $item->getIcon() . '"></i> <span>' . $item->getTexto() . '</span>' . $pullRight .
            '</a>';

        if (is_array($subNivel)) {
            $li .= '<ul class="treeview-menu">';
            $li .= renderItens($subNivel);
            $li .= '</ul>';
        }

        $li .= '</li>';
    }

    return $li;
}
?>
<ul class="sidebar-menu">
    <?php echo renderItens($menu->getItensMenu())?>
</ul>
