@extends('front.layout.master')
@section('title','İletişim')
@section('bg', asset('front/assets/img/contact-bg.jpg'))

@section('content')

<div class="col-md-10 col-lg-8 col-xl-7">
    @if(session('success'))

    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                <li>
                    {{$error}}
                </li>

                @endforeach
            </ul>

        </div>

        @endif
        <p>Bizimle iletişime geçin!</p>


        <form  method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="form-group">
                <label for="name">Ad Soyad</label>
                <input class="form-control" id="name" type="text" value="{{old("name")}}" name="name" placeholder="Ad Soyad giriniz" />
                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
            </div>

            <div class="form-group">
                <label for="email">Email addresi</label>
                <input class="form-control"  type="email" value="{{old('email')}}" name="email" placeholder="E-mail adresiniz." />

            </div>

            <div class="control-group">
                <div class="form-group col-xs-12 controls">
                    <label for="topic">Konu</label>
                    <br>
                    <select class="form-control" id="topic" name="topic">
                        <option @if (old('topic')=="Bilgi") selected @endif>Bilgi</option>
                        <option @if (old('topic')=="Destek") selected @endif>Destek</option>
                        <option @if (old('topic')=="Genel") selected @endif>Genel</option>
                    </select>
                </div>
            </div>

            <br>

            <div class="control-group">
                <div class="form-group controls">
                    <label for="message">Mesaj</label>
                    <textarea class="form-control" id="message"  name="message" rows="5"  placeholder="Mesajınızı buraya yazın...">{{old('message')}}</textarea>
                </div>
            </div>

            <br />

            <!-- Submit success message-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center mb-3">
                    <div class="fw-bolder">Form submission successful!</div>
                    To activate this form, sign up at
                    <br />
                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                </div>
            </div>

            <!-- Submit error message-->
            <div class="d-none" id="submitErrorMessage">
                <div class="text-center text-danger mb-3">Error sending message!</div>
            </div>

            <!-- Submit Button-->
            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Gönder</button>
        </form>

</div>
<div class="col-md-4">





</div>
@endsection
