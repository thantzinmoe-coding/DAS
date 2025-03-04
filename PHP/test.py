import os

# Set the path where your extracted files are located
folder_path = "C:/wamp64/www/DAS/uploads"

# for index in range(100):
#     print(index)
# Loop through files and rename .jpg files
for index, filename in enumerate(os.listdir(folder_path), start=18):
    if filename.lower().endswith(".jpg"):
        old_path = os.path.join(folder_path, filename)
        new_filename = f"doctor1-{index}.jpg"  # Change naming pattern as needed
        new_path = os.path.join(folder_path, new_filename)
        os.rename(old_path, new_path)
        print(f"Renamed: {filename} → {new_filename}")

print("Renaming completed!")

# import torch
# from torchvision import models, transforms
# from PIL import Image
# import matplotlib.pyplot as plt
# import cv2

# # Load the Faster R-CNN model
# model = models.detection.fasterrcnn_resnet50_fpn(pretrained=True)
# model.eval()

# # Load and preprocess the image
# image_path = "C:/wamp64/www/DAS/Image/profile2.png"
# image = Image.open(image_path).convert("RGB")
# transform = transforms.Compose([transforms.ToTensor()])
# image_tensor = transform(image).unsqueeze(0)

# # Perform object detection
# with torch.no_grad():
#     predictions = model(image_tensor)

# # Extract detected objects
# labels = predictions[0]['labels'].tolist()
# scores = predictions[0]['scores'].tolist()

# # COCO label mapping (common objects)
# coco_labels = {1: "person", 32: "tie", 33: "suitcase", 44: "bottle", 77: "cell phone"}

# detected_objects = [coco_labels[label] for label, score in zip(labels, scores) if score > 0.6 and label in coco_labels]

# print("Detected Objects:", detected_objects)

