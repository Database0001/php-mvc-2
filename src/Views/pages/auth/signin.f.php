<?= view('layouts.header', ['title' => "Giriş yap"]) ?>

<style>
    body {
        display: flex;
        align-items: center;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        margin: auto;
    }
</style>

<main class="form-signin mt-5">
    <form method="POST" class="text-center" request-form="auth">
        <h1 class="h3 mb-3 fw-normal">Giriş yap</h1>

        <div class="form-floating">
            <input type="text" id="username" name="username" class="form-control mt-1" placeholder="Kullanıcı adı">
            <label for="username">Kullanıcı adı</label>
        </div>
        <div class="form-floating">
            <input type="password" id="password" name="password" class="form-control mt-1" placeholder="Şifre">
            <label for="password">Şifre</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-1" type="submit">Giriş yap</button>
    </form>
</main>

<?= view('layouts.footer') ?>