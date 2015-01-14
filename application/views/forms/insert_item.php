
        <form target="<?php echo URL_X . 'shop/insert'; ?>" method="POST">
            <label>Item Name</label>
            <input type="text" name="item_name" placeholder="Enter text here"/>
            <br/>

            <label>Item category</label>
            <select name="item_category">
                <option value="0" selected="">Choose a category</option>
                <option value="1">cat-1</option>
                <option value="2">cat-2</option>
                <option value="3">cat-3</option>
                <option value="4">cat-4</option>
            </select>
            <br/>
           
            

            <input type="submit" value="Save in register"/>
            <input type="reset" value="Clear"/>




        </form>
 

