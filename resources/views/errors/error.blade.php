@if($errors->any())
    <div class="mb-5">
        <?php echo implode('', $errors->all('<div class="text-danger mb-1">:message</div>')); ?>
    </div>
@endif

{{-- show message --}}
@if(Session::has('success'))
<p class="text-success">{{ Session::get('success') }}</p>
@endif

{{-- show error message --}}
@if(Session::has('error'))
<p class="text-danger">{{ Session::get('error') }}</p>
@endif