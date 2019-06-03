from os import listdir
import tempfile
from pdf2image.exceptions import (
    PDFInfoNotInstalledError,
    PDFPageCountError,
    PDFSyntaxError
)

mypath = './'
print(listdir(mypath))
here = listdir(mypath)
for item in here:
    with tempfile.TemporaryDirectory() as path:
         images_from_path = convert_from_path(item, output_folder='./')
