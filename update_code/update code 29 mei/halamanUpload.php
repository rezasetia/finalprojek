<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link href="./output.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once 'header.php';
    ?>

    <p class="text-blue font-semibold text-center text-3xl mb-4">Fill in the following data below correctly</p>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="flex h-screen w-full">
            <div class=" p-6  ">
                <!-- kotak tengah -->
                <div class="p-4 ">
                    <h2 class="text-lg"> <b>Upload Image</b></h2>
                    <div class="py-6 mb-4    border border-gray-400 px-4 rounded-md">
                        <input type="file" name="image" id="image" required class="py-8 border px-8  pb-10 ">
                        <p class="font-semibold text-center mt-4">Ukuran file dokumen Anda tidak boleh melebihi 100 MB</p>
                        <div class="flex items-center justify-center gap-4">
                            <img src="./asset/gambar3.png" alt="Gambar 3" class="h-30 " width="100">
                            <img src="./asset/gambar2.png" alt="Gambar 2" class="h-30 " width="100">
                            <img src="./asset/gambar1.png" alt="Gambar 1" class="h-30 " width="100">
                        </div>
                    </div>
                </div>
                <div class=" ">
                    <div class="w-full flex flex-col">
                        <label for="description"><b>Deskripsi</b></label>
                        <textarea class="border" name="description" id="description" cols="70" rows="9"></textarea><br>
                    </div>

                </div>

                <div class="flex justify-center">
                    <button class="px-8 py-4 border  bg-customBlue hover:bg-customHoverBlue rounded-md cursor-pointer text-white" type="submit" name="upload">Upload</button>

                </div>
            </div>


        </div>
    </form>
</body>

</html>

</html>