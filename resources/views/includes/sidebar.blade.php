<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        @if($userData == "client")
            @include('includes.partials.client')
        @elseif($userData == "admin")
            @include('includes.partials.admin')
        @endif
    </ul>
</div>