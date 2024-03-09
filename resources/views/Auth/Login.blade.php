 @extends('layouts.login')
 @section('title', 'Login Story Apps')

 @section('content')
     {{--
     <section class="ftco-section">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-md-6 text-center mb-5">

                 </div>
             </div>
             <div class="row justify-content-center">
                 <div class="col-md-7 col-lg-5">
                     <div class="login-wrap p-4 p-md-5">
                         <a href="{{ route('StoryApps') }}"><i class="fa fa-arrow-left"></i></a>
                         <div class="icon d-flex align-items-center justify-content-center">
                             <span class="fa fa-user-o"></span>
                         </div>

                         <h3 class="text-center mb-4">Sign In</h3>
                         <form action="{{ route('LoginUserPost') }}" class="login-form" method="post">
                             @csrf
                             <div class="form-group">
                                 <input type="text" class="form-control rounded-left" placeholder="email" name="email"
                                     required>
                             </div>
                             <div class="form-group d-flex">
                                 <input type="password" class="form-control rounded-left" placeholder="Password"
                                     name="password" required>
                             </div>
                             <div class="form-group">
                                 <button type="submit" name="submit"
                                     class="form-control btn btn-primary rounded submit px-3">Login</button>
                             </div>
                             <div class="form-group d-md-flex">
                                 <div class="w-50">
                                     <label class="checkbox-wrap checkbox-primary">Remember Me
                                         <input type="checkbox" checked>
                                         <span class="checkmark"></span>
                                     </label>
                                 </div>
                                 <div class="w-50 text-md-right">
                                     <a href="#">Forgot Password</a>
                                 </div>
                             </div>
                             <div style="text-align: center;">
                                 <a href="{{ route('registerUser') }}">Belum Punya Akun? Daftar</a>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </section> --}}


     @if (session('success'))
         <div id="successMessage" class="alert alert-success mt-2">
             {{ session('success') }}
         </div>
     @elseif (session('error'))
         <div class="alert alert-danger mt-2">
             Failed.
         </div>
     @endif
     <form action="{{ route('LoginUserPost') }}" id="login-form" class="login" method="post">
        <a href="{{ route('StoryApps') }}"><i class="fa fa-arrow-left" style="color: white;"></i></a>
         @csrf
         <h2 class="title">Login</h2>
         <div class="input">
             <input type="email" id="username" name="email" placeholder="Email" required>
             <input type="password" id="password" name="password" placeholder="Password" required>
             <input type="hidden" id="active" name="active" placeholder="active" value="1">
             <div class="bawah">
                 <div class="check">
                     <input type="checkbox" id="remember-me" name="remember-me">
                     <label for="remember-me">Remember Me</label>
                 </div>
                 <div class="forget-password">
                     <a href="/forgot-password">Forget Password?</a>
                 </div>
             </div>
         </div>
         <input type="submit" value="Login" name="submit">
         <div class="text">OR</div>
         <div class="sosmed-1">
             <div class="sosmed"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="22" height="25"
                         viewBox="0 0 256 262">
                         <path fill="#4285f4"
                             d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                         <path fill="#34a853"
                             d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                         <path fill="#fbbc05"
                             d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                         <path fill="#eb4335"
                             d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                     </svg></a></div>
             <div class="sosmed"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="22" height="25"
                         viewBox="0 0 256 258">
                         <defs>
                             <linearGradient id="logosWhatsappIcon0" x1="50%" x2="50%" y1="100%"
                                 y2="0%">
                                 <stop offset="0%" stop-color="#1faf38" />
                                 <stop offset="100%" stop-color="#60d669" />
                             </linearGradient>
                             <linearGradient id="logosWhatsappIcon1" x1="50%" x2="50%" y1="100%"
                                 y2="0%">
                                 <stop offset="0%" stop-color="#f9f9f9" />
                                 <stop offset="100%" stop-color="#fff" />
                             </linearGradient>
                         </defs>
                         <path fill="url(#logosWhatsappIcon0)"
                             d="M5.463 127.456c-.006 21.677 5.658 42.843 16.428 61.499L4.433 252.697l65.232-17.104a122.994 122.994 0 0 0 58.8 14.97h.054c67.815 0 123.018-55.183 123.047-123.01c.013-32.867-12.775-63.773-36.009-87.025c-23.23-23.25-54.125-36.061-87.043-36.076c-67.823 0-123.022 55.18-123.05 123.004" />
                         <path fill="url(#logosWhatsappIcon1)"
                             d="M1.07 127.416c-.007 22.457 5.86 44.38 17.014 63.704L0 257.147l67.571-17.717c18.618 10.151 39.58 15.503 60.91 15.511h.055c70.248 0 127.434-57.168 127.464-127.423c.012-34.048-13.236-66.065-37.3-90.15C194.633 13.286 162.633.014 128.536 0C58.276 0 1.099 57.16 1.071 127.416m40.24 60.376l-2.523-4.005c-10.606-16.864-16.204-36.352-16.196-56.363C22.614 69.029 70.138 21.52 128.576 21.52c28.3.012 54.896 11.044 74.9 31.06c20.003 20.018 31.01 46.628 31.003 74.93c-.026 58.395-47.551 105.91-105.943 105.91h-.042c-19.013-.01-37.66-5.116-53.922-14.765l-3.87-2.295l-40.098 10.513z" />
                         <path fill="#fff"
                             d="M96.678 74.148c-2.386-5.303-4.897-5.41-7.166-5.503c-1.858-.08-3.982-.074-6.104-.074c-2.124 0-5.575.799-8.492 3.984c-2.92 3.188-11.148 10.892-11.148 26.561c0 15.67 11.413 30.813 13.004 32.94c1.593 2.123 22.033 35.307 54.405 48.073c26.904 10.609 32.379 8.499 38.218 7.967c5.84-.53 18.844-7.702 21.497-15.139c2.655-7.436 2.655-13.81 1.859-15.142c-.796-1.327-2.92-2.124-6.105-3.716c-3.186-1.593-18.844-9.298-21.763-10.361c-2.92-1.062-5.043-1.592-7.167 1.597c-2.124 3.184-8.223 10.356-10.082 12.48c-1.857 2.129-3.716 2.394-6.9.801c-3.187-1.598-13.444-4.957-25.613-15.806c-9.468-8.442-15.86-18.867-17.718-22.056c-1.858-3.184-.199-4.91 1.398-6.497c1.431-1.427 3.186-3.719 4.78-5.578c1.588-1.86 2.118-3.187 3.18-5.311c1.063-2.126.531-3.986-.264-5.579c-.798-1.593-6.987-17.343-9.819-23.64" />
                     </svg></a></div>
             <div class="sosmed"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="22" height="25"
                         viewBox="0 0 24 24">
                         <path fill="#002aff"
                             d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4z" />
                     </svg></a></div>
         </div>
         <div class="text">Don't have an account? <a href="{{ route('registerUser') }}">Register</a></div>
     </form>
 @endsection
