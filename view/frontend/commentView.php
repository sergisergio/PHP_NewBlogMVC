<?php ob_start(); ?>
    <h1 class="text-center"> Modification de commentaire</h1>
    <!--<p class="text-center"><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Retour au billet</a></p>-->
    
            <h2 class="text-center">Modifier un commentaire</h2>
            <form action="index.php?action=modifyComment&amp;id=<?= $commentId ?>&amp;post_id=<?= $data['post_id']; ?>" method="post"  class="text-center">
                <div class="text-center">
                    <label for="author">Auteur</label>
                    <br />
                    <input type="text" id="author" name="author" value="<?= htmlspecialchars($data['author']) ?>" /> </div>
                <div>
                    <label for="comment">Commentaire</label>
                    <br />
                    <textarea id="comment" name="comment">
                         <?= htmlspecialchars($data['comment']) ?>
                    </textarea>
                </div>
                <div>
                    <input type="submit" /> 
                </div>
            </form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>