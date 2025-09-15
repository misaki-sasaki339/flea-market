@extends(layouts.app)

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/mypage') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="profile">
        <div class="profile__content">
            <img src="" alt="" class="avator_img" />
            <span class="name">{{ Auth::user->name() }}</span>
        </div>
        <div class="profile__edit">
            <form action="{{ route('mypage.edit') }}" method="get">
                @csrf
                <button class="profile__edit-button" type="submit">プロフィールを編集</button>
            </form>
        </div>
    </section>

    <section class="list-item">
        <div class="tab-switch">
            <label><input type="radio" name="tab" checked />出品した商品</label>
            <!--下線表示の方法検討-->
            <div class="tab-content">
                <!--@foreachで表示-->
            </div>

            <label><input type="radio" name="tab" />購入した商品</label>
            <!--下線表示の方法検討-->
            <div class="tab-content">
                <!--favorite使って@foreach表示-->
            </div>
        </div>
    </section>
</div>
@endsection