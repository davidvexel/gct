
<script type="text/javascript" src="ckeditor.js"></script>

	<form action="sample.php" method="post">

<textarea cols="80" id="editor1" name="editor1" rows="10"> </textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1', { <?php include('basicjs.php'); ?> } )
			</script>
            
            <textarea cols="80" id="editor2" name="editor2" rows="10"> </textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor2', { <?php include('basicjs.php'); ?>} )
			</script>

		  <input type="submit" value="Submit" />

	</form>

