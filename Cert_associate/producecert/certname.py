import numpy as np
import cv2
from PIL import ImageFont, ImageDraw, Image

img = cv2.imread("../Cert/Pecu.png")
text = '徐 子 修'

img = np.rot90(img)
imgPil = Image.fromarray(img)
fontPath = "./wt005.ttf"
font = ImageFont.truetype(fontPath, 56)

draw = ImageDraw.Draw(imgPil)
draw.text((310,270),text, font = font, fill = (0, 0, 0))

img = np.array(imgPil)
cv2.imwrite('./result/徐子修.png',img)
cv2.destroyAllWindows()