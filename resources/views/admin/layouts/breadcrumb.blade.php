<!-- Content Header (Page header) -->
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="{{ url(Request::segment(1)) }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <?php $layer = 1; $root= 0; ?>
        @for($i = 2; $i <= count(Request::segments()); $i++)
            <?php $url = ""; ?>
            @for($j = 1; $j <= $layer; $j++)
                <?php $url .= Request::segment($root + $j). "/"; ?>
            @endfor
            <?php $layer++; ?>
            <li>
                <a href="{{ url($url. Request::segment($i)) }}">{{Request::segment($i)}}</a>
            </li>

        @endfor

    </ol>
</section>

<br/>