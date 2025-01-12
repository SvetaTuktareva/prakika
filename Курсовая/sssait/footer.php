
<style>
:root {
  --primary-color: gray;
  --secondary-color: #007BFF;
  --light-grey: #f4f4f4;
  --shadow-color: rgba(0, 0, 0, 0.2);
 }
 body {
     display: flex;
     flex-direction: column; 
     min-height: 100vh;
     margin: 0;
     font-family: Arial, sans-serif;
 }

 main {
     flex: 1;
 }

 footer {
     background-color: #333;
     color: white;
     padding: 20px;
     text-align: center;
 }

 header {
     background-color: var(--primary-color);
     color: white;
     padding: 1rem 0;
     text-align: center;
 }



.site-footer {
    text-align: center;
    padding: 1rem 0;
    background-color: var(--primary-color);
    color: white;
}
</style>
<footer class="site-footer">
  <p>&copy; <?php echo date('Y'); ?> Салон красоты. Все права защищены.</p>
</footer>
