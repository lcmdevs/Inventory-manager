// Apenas números nos inputs
function num(dom){
dom.value=dom.value.replace(/\D/g,'');
}

$(function(){
	//Pesquisar os cursos sem refresh na página
	$("#material").keyup(function(){
		
		var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}		
			$.post('home.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$(".resultado").html(retorna);
			});
		}else{
			$(".resultado").html('');
		}		
	});
});
