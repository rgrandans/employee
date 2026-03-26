FROM node:25-alpine

WORKDIR /app

# Copy only package.json and package-lock.json first to install dependencies
COPY ./web/package*.json .

# Install dependencies
RUN npm install

# Copy the rest of the app files
COPY ./web .

# Expose the Vue development server port
EXPOSE 5173

# Start the Vue development server
CMD ["npm", "run", "serve"]