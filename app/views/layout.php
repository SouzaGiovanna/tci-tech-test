<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/colors.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Agenda</title>
</head>
<body class="bg-primary text-primary position-relative">
    <main class="w-100 h-95 p-3">
        <div class="tab-content h-100 px-4" id="content">
            <div class="tab-pane fade show active h-100 w-100" id="contacts-tab" role="tabpanel" aria-labelledby="contacts-tab-btn">
                <h2>Contatos</h2>
                <hr>
                <div class="d-flex justify-content-between mt-4 mb-5">
                    <button type="button" id="contact-modal-btn" class="btn btn-primary m-s" data-toggle="modal" data-target="#form-contacts-modal">
                        <i class="fa-solid fa-plus"></i> Adicionar
                    </button>
                    <div class="">
                        <div class="border p-1 px-3 search border-secondary bg-primary rounded-3 d-flex justify-content-center align-items-center ">
                            <i class="fa-solid fa-search text-secondary me-3"></i>
                            <input id="search-input" type="text-primary border-0 outline-none">
                        </div>
                    </div>
                </div>
                <?php echo $this->section('content')?>
            </div>
        </div>
    </main>
    <footer class="d-flex h-5 justify-content-center bg-secondary align-items-center">
            <p>©️ Desenvolvido por Giovanna Souza</p>
    </footer>
    <!-- Modal -->
    <div class="modal fade text-primary" id="form-contacts-modal" tabindex="-1" role="dialog" aria-labelledby="form-contactsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="form-contactsLabel">Inserir Contato:</h5>
                    <button type="button" id="close-contact-modal-btn" class="btn-close text-secondary" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-secondary">
                    <div class="h-50 w-75 m-auto">
                        <form method="POST" action="/contacts/" id="form-contacts" class="form-contact d-flex flex-column gap-3">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" class="form-control bg-secondary border-secondary" placeholder="Digite o nome" id="name" name="name" required>
                                <span class="d-none text-danger error-message">Nome deve ter entre 3 e 255 caracteres</span>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control bg-secondary border-secondary" placeholder="exemplo@exemplo.com" aria-describedby="emailHelp" id="email" name="email" required>
                                <span class="d-none text-danger error-message">Nome deve ter entre 3 e 255 caracteres</span>
                                <small id="emailHelp" class="form-text text-muted">Nós nunca compartilharemos seu email com ninguém.</small>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="document">CPF:</label>
                                    <input type="text" class="form-control bg-secondary border-secondary" placeholder="Digite o CPF"  id="document" name="document" required>
                                    <span class="d-none text-danger error-message">Cpf deve ser válido</span>
                                </div>
                                <div class="form-group col">
                                    <label for="phone">Telefone:</label>
                                    <input type="text" class="form-control bg-secondary border-secondary" placeholder="Digite o Telefone"  id="phone" name="phone" required>
                                    <span class="d-none text-danger error-message">Telefone deve ser válido</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alias">Apelido:</label>
                                <input type="text" class="form-control bg-secondary border-secondary" placeholder="Digite o apelido" id="alias" name="alias">
                                <span class="d-none text-danger error-message">Nome deve ter entre 3 e 55 caracteres</span>
                            </div>
                            <button type="submit" class="btn btn-lg ms-auto text-primary bg-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Toast -->
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-absolute left fade bg-secondary" id="api-message-toast" data-autohide="true" data-delay="1500">
        <div class="toast-body">
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/public/js/serialize-jquery.js"></script>
<script src="/public/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f3495c0611.js" crossorigin="anonymous"></script>
</body>

</html>
