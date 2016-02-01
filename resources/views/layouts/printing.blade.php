<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CEB | PRINTING</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- partials.css --}}
    <style type="text/css"  media="print">
          @media print {
            body, html, .invoice,wrapper {
                width: 100%;
                font-size: 10px;
            }

      }
      @page {
        margin: 0;
      }
    </style>
    <!-- aaddiing heree piece ddebbuurree priinnt seccttiioonn--->
    <link rel="stylesheet" type="text/css" href="{!! url('/assets/dist/css/report.css') !!}">
    @yield('headercss')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <div class="row no-print">
            <div class="col-xs-12">
              <button onclick="window.print();" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
            </div>
          </div>
        <!-- title row -->
        <img src="{!! url('assets/images/header.png') !!}" style=" display: block;margin-left: auto;margin-right: auto;">
        <br/>
        {!! $report !!}
          <div class="row no-print">
            <div class="col-xs-12">
              <button onclick="window.print();" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
            </div>
          </div>
        </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
  </body>
</html>
