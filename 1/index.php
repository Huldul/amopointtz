<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Загрузка файла</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Загрузите файл</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" class="form-control" name="file" accept=".txt">
            </div>
            <button type="submit" class="btn btn-primary" name="upload">Загрузить</button>
        </form>
    </div>
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Результат</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($_POST['upload'])) {
                        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                            $folder = 'files/';
                            $filename = basename($_FILES['file']['name']);
                            $filePath = $folder . $filename;
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                            if ($fileExtension !== 'txt') {
                                echo '<div class="status error"></div>';
                                echo "<p>Ошибка: можно загружать только текстовые файлы.</p>";
                            } else {
                                if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                                    echo '<div class="status success"></div>';
                                    echo "<p>Файл успешно загружен: $filename</p>";

                                    $fileContents = file_get_contents($filePath);
                                    $lines = explode(",", $fileContents);

                                    foreach ($lines as $line) {
                                        $digitCount = preg_match_all('/\d/', $line);
                                        echo "<p>$line = $digitCount цифр</p>";
                                    }
                                } else {
                                    echo '<div class="status error"></div>';
                                    echo "<p>Ошибка: не удалось загрузить файл.</p>";
                                }
                            }
                        } else {
                            echo '<div class="status error"></div>';
                            echo "<p>Ошибка: файл не был загружен.</p>";
                        }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onload = function() {
            const modal = new bootstrap.Modal(document.getElementById('resultModal'));
            if (document.querySelector('.modal-body').innerHTML.trim() !== '') {
                modal.show();
            }
        }
    </script>
</body>
</html>
