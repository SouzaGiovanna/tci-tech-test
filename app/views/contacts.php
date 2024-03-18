<?php $this->layout('layout') ?>

<table id="contacts-table" class="table">
    <thead class="text-secondary fw-normal ">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Apelido</th>
            <th scope="col">Email</th>
            <th scope="col">Documento</th>
            <th scope="col">Telefone</th>
            <th scope="col"><i class="fa-solid me-2 d-none"></i><a data-filter="created_at" href="#" class="text-decoration-none a-filter">Criado em:</a></th>
            <th scope="col"><i class="fa-solid me-2 d-none"></i><a data-filter="updated_at" href="#" class="text-decoration-none a-filter">Editado em:</a></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody class="text-primary ">
        <?php foreach($contacts as $contact): ?>
            <tr>
                <td><?= $contact['name'] ?></td>
                <td><?= $contact['alias'] ?></td>
                <td><?= $contact['email'] ?></td>
                <td><?= $contact['document'] ?></td>
                <td><?= $contact['phone'] ?></td>
                <td><?= $contact['created_at'] ?></td>
                <td><?= $contact['updated_at'] ?></td>
                <td>
                    <button type="button" class="btn btn-primary" onclick="editContact(<?= $contact['id'] ?>)" data-mdb-toggle="modal" data-mdb-target="#form-contacts">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <a type="button" class="btn btn-primary" onclick="eraseContact(<?= $contact['id'] ?>)">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if(count($contacts) === 0): ?>
            <tr>
                <td colspan="7" class="text-center">Nenhum contato encontrado</td>
            </tr>
        <?php endif; ?> 
    </tbody>
</table>
