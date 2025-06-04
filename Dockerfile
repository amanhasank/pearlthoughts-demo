FROM schmunk42/yii2-app-basic

# Copy your app code into the image
COPY ./myapp /app

# Expose port 80
EXPOSE 80
