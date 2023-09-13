@auth
@if (Auth::user()->perfil->ID==1)<!-- PERFIL ADMINISTRADOR -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU DO ADMINISTRADOR</li>
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-map-o"></i> <span>Usuário</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('admin.usuario.listUser')}}"><i class="fa fa-file-text"></i> <span>Listar</span></a></li>
            <li><a href="{{route('admin.usuario.createUser')}}"><i class="fa fa-file-text"></i> <span>Cadastrar</span></a></li>
        </ul>
    </li>
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-map-o"></i> <span>Processo</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('usuario.listarProcessos') }}"><i class="fa fa-search"></i> Acompanhamentos</a></li>
        </ul>
    </li>
    <li>
        {{-- <a href="#">
            <i class="fa fa-search-minus"></i> <span>Logs do Sistema</span>
        </a> --}}
    </li>
    {{-- <li><a href="#"><i class="fa fa-book"></i> <span>Manual do Usuário</span></a></li> --}}
</ul>
@elseif (Auth::user()->perfil->ID==2)<!-- PERFIL UNIDADE PAGADORA -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU DA UPAG</li>
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-map-o"></i> <span>Processo</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoUpag.create') }}"><i class="fa fa-arrow-right"></i> Criar</a></li>
            {{-- <li><a href="{{ route('processoUpag.resumoPendencias') }}"><i class="fa fa-clock-o"></i> Pendentes</a></li> --}}
            <li><a href="{{ route('usuario.listarProcessos') }}"><i class="fa fa-arrow-right"></i> Acompanhamentos</a></li>
            <li><a href="{{ route('processoSdpp.devolvidosSdpp') }}"><i class="fa fa-arrow-right"></i> Devolvidos para Acerto</a></li>
            <li><a href="{{ route('processoUpag.finalizadoSdpp') }}"><i class="fa fa-arrow-right"></i> Finalizado SDPP</a></li>
            <li><a href="{{ route('processoUpag.finalizadoUpag') }}"><i class="fa fa-arrow-right"></i> Finalizado UPAG</a></li>
            <li><a href="{{ route('relatorios.opcoesUpag') }}"><i class="fa fa-arrow-right"></i> Relatório Analítico</a></li>
        </ul>
    </li>
    {{-- <li><a href="#" target="_blank"><i class="fa fa-book"></i> <span>Manual do Usuário</span></a></li> --}}
</ul>
@elseif (Auth::user()->perfil->ID==3)<!-- PERFIL CONSULTA -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU DE CONSULTA</li>
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-map-o"></i> <span>Processo</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('usuario.listarProcessos') }}"><i class="fa fa-arrow-right"></i>Acompanhamentos</a></li>
        </ul>
    </li>
    {{-- <li><a href="{{ asset('docs/manual_COMISSAO.pdf') }}" target="_blank"><i class="fa fa-book"></i> <span>Manual do Usuário</span></a></li> --}}
</ul>
@elseif (Auth::user()->perfil->ID==4)<!-- PERFIL SDPP -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU DA SDPP</li>
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-map-o"></i> <span>Processo</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoSdpp.iniciadosSdpp') }}"><i class="fa fa-arrow-right"></i> Pedidos de Reversão</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoSdpp.enviadosSdpp') }}"><i class="fa fa-arrow-right"></i> Enviados ao Banco</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoSdpp.concluidosSdpp') }}"><i class="fa fa-arrow-right"></i> Concluídos</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoSdpp.devolvidosSdpp') }}"><i class="fa fa-arrow-right"></i> Devolvidos</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoUpag.finalizadoSdpp') }}"><i class="fa fa-arrow-right"></i> Finalizado SDPP</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('usuario.listarProcessos') }}"><i class="fa fa-arrow-right"></i> Acompanhamentos</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoSdpp.listarExcluidos') }}"><i class="fa fa-arrow-right"></i> Processos Excluídos</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoSdpp.atrasadosSdpp') }}"><i class="fa fa-arrow-right"></i> Respostas Pendentes</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('processoSdpp.listarReiteradosSdpp') }}"><i class="fa fa-arrow-right"></i> Reiterados</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="{{ route('relatorios.opcoesSDPP') }}"><i class="fa fa-arrow-right"></i> Relatórios Analíticos</a></li>
        </ul>
        {{-- <ul class="treeview-menu">
            <li><a href="{{ route('dashboard.alimentaDashboard') }}"><i class="fa fa-paper-plane-o"></i> Dashboard Sintético</a></li>
        </ul> --}}
    </li>
    {{-- <li><a href="{{ asset('docs/manual_ACI.pdf') }}" target="_blank"><i class="fa fa-book"></i> <span>Manual do Usuário</span></a></li> --}}
</ul>
@endif
@endauth 

