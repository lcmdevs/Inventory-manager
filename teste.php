


<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
<link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
<link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css">

<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="sim" 
                      data-whatevernome="<?php echo $row['nome']; ?>" data-whateveremail="<?php echo $row['email']; ?>">Editar</button>
</a>



</td>

</tr>
<!-- Tela que abre após -->
<div class="modal fade" id="myModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:black;"><?php echo $row['nome'] ?></h4>
                <div class="modal-body">
                    <p><strong>Nome:</strong><?php echo $row['nome']; ?></p>
                    </h2>
                    <p><strong>Email:</strong><?php echo $row['email']; ?></p>


                </div>
            </div>
        </div>
    </div>

</div>


</div>

</tbody>

</table>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="update.php">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label" name="nome">Nome:</label>
                        <input type="text" class="form-control" id="recipient-name" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label" name="email" id="email">Email:</label>
                        <textarea class="form-control" id="message-text" name="email"></textarea>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Alterar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    //usado no botao visualizar
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever')
        var recipientnome = button.data('whatevernome')
        var recipientemail = button.data('whateveremail')
        // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('ID:' + recipient)
        modal.find('.modal-body input').val(recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-name').val(recipientnome)
        modal.find('#message-text').val(recipientemail)

    })
</script>

<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/Popper.js/dist/Popper.js"></script>
<script src="script/validar.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>