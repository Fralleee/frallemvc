
  <script>
    var images = document.querySelectorAll('img');
    [].forEach.call(images, function(img) {
      AntiModerate.process(img, img.getAttribute("data-antimoderate-idata"), img.getAttribute("data-antimoderate-scale"));
    });
  </script>
</div>
<footer>
<center>Footer</center>
</footer>
</body>
</html>