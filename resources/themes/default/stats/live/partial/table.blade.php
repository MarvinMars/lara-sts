<div class="table-responsive">
    <table class="table">
        @isset($head)
            <thead>
                {{ $head }}
            </thead>
        @endisset
        @isset($body)
            <tbody>
                {{ $body }}
            </tbody>
        @endisset
        @isset($footer)
            <tfoot>
                {{ $footer }}
            </tfoot>
        @endisset
    </table>
</div>