</div>
<script>
			function PutAttack(name, id)
			{ 
				if($('#at1').html() == '')
				{
					$('#at1').html(name);
					$('#tech1').val(id);
					$('#at1').click(function()
						{
							$('#at1').html('');
							$('#tech1').val(0);
						});
				}else
					if($('#at2').html() == '')
					{
						$('#at2').html(name);
						$('#tech2').val(id);
						$('#at2').click(function()
							{
								$('#at2').html('');
								$('#tech2').val(0);
							});
					}else
						if($('#at3').html() == '')
						{
							$('#at3').html(name);
							$('#tech3').val(id);
							$('#at3').click(function()
								{
									$('#at3').html('');
									$('#tech3').val(0);
								});
						}else return;
			}
</script>
</body>
</html>