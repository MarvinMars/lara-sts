<div class="row">
    <div class="col col-sm-12">
        <section class="stats--table-container">
            @if(isset($title))
                <h4 class="stats--table-title">
                    {{ $title }}
                </h4>
            @endif
            <div class="table_wrap">
                <div class="table_main">
                    {{ $slot }}
                </div>

                @if(isset($table_overlay))
                    <div class="table_overlay">
                        {{ $table_overlay }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>

