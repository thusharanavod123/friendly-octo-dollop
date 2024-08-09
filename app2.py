from flask import Flask, request, jsonify, send_file
from flask_cors import CORS
import torch
from PIL import Image, ImageDraw, ImageFont
import io
import base64

app = Flask(__name__)
CORS(app)

# Load YOLOv5 model
model = torch.hub.load('ultralytics/yolov5', 'custom', path='yolov5s.pt')

@app.route('/predict_image', methods=['POST'])
def predict_image():
    if 'file' not in request.files:
        return "No file part", 400
    
    file = request.files['file']
    if file.filename == '':
        return "No selected file", 400
    
    # Read image from file-like object
    image = Image.open(io.BytesIO(file.read()))
    
    # Perform object detection
    results = model(image)
    
    # Process detection results and annotate image
    annotated_image = annotate_image(image, results)
    
    # Save annotated image to a temporary file
    temp_image_path = 'C:/Users/User/Desktop/yolo model/yolov5/tmp/annotated_image.jpg'
    annotated_image.save(temp_image_path)
    
    # Return detection results and send annotated image
    return jsonify({
        'results': results.pandas().xyxy[0].to_dict(orient="records"),
        'annotated_image_url': f'http://localhost:5000/annotated_image'
    })

@app.route('/predict_video', methods=['POST'])
def predict_video():
    data = request.get_json()
    image_data = data['image']
    image = Image.open(io.BytesIO(base64.b64decode(image_data.split(',')[1])))
    
    # Perform object detection
    results = model(image)
    
    # Process detection results
    return jsonify({
        'results': results.pandas().xyxy[0].to_dict(orient="records")
    })

@app.route('/annotated_image')
def get_annotated_image():
    temp_image_path = 'C:/Users/User/Desktop/yolo model/yolov5/tmp/annotated_image.jpg'
    return send_file(temp_image_path, mimetype='image/jpeg')

def annotate_image(original_image, results):
    annotated_image = original_image.copy()
    draw = ImageDraw.Draw(annotated_image)
    font = ImageFont.load_default()
    
    for result in results.pandas().xyxy[0].to_dict(orient="records"):
        label = result['name']
        confidence = result['confidence']
        xmin, ymin, xmax, ymax = result['xmin'], result['ymin'], result['xmax'], result['ymax']
        
        # Checking whether it is a farm animal
        if label == "cow":
            # Draw bounding box
            draw.rectangle([(xmin, ymin), (xmax, ymax)], outline='green', width=4)
            # Add label and confidence
            draw.text((xmin, ymin - 10), f'{label} {confidence:.2f}', fill='red', font=font)
    
    del draw
    return annotated_image

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
