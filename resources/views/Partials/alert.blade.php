<textarea id="dummyTextErrors" cols="30" rows="10" hidden>
    <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</textarea>

<textarea id="dummyTextError" cols="30" rows="10" hidden>
    @if (session()->has('error'))
        {{ session()->get('error') }}
    @endif
</textarea>

<textarea id="dummyTextInfo" cols="30" rows="10" hidden>
    @if (session()->has('info'))
        {{ session()->get('info') }}
    @endif
</textarea>

<textarea id="dummyTextSuccess" cols="30" rows="10" hidden>
    {{ session()->get('success') }}

    @if(session('status'))
    
    {{ session('status') }}
    
    @elseif(session('status') == 'verification-link-sent')
    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    @endif
</textarea>

@if($errors->any())
<script>
const dummyTextErrors = document.querySelector('#dummyTextErrors');

Swal.fire({
  icon: 'error',
  title: 'Oops...',
  html: dummyTextErrors.value,
})
</script>
@endif

@if(session()->has('error'))
<script>
const dummyTextError = document.querySelector('#dummyTextError');

    Swal.fire({
      icon: 'error',
      title: 'Failed',
      text: dummyTextError.value,
    });
</script>
@endif

@if(session()->has('info'))
<script>
const dummyTextInfo = document.querySelector('#dummyTextInfo');

    Swal.fire({
      icon: 'info',
      title: 'Info',
      text: dummyTextInfo.value,
    });
</script>
@endif

@if(session()->has('success'))
<script>
const dummyTextSuccess = document.querySelector('#dummyTextSuccess');

    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: dummyTextSuccess.value,
    });
</script>
@endif

@if (session('status'))
<script>
  const dummyTextSuccess = document.querySelector('#dummyTextSuccess');
  
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: dummyTextSuccess.value,
      });
  </script>
@endif