# app/Dockerfile
FROM python:3.9-slim

WORKDIR /app

COPY requirements.txt requirements.txt
RUN pip install -r requirements.txt

COPY . .

CMD ["python", "server.py"]


# db/Dockerfile
FROM sqlite:latest

WORKDIR /db

COPY data.db .
