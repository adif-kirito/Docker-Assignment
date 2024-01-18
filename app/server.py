# server.py
from flask import Flask, render_template, request, jsonify
import sqlite3

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/calculate', methods=['POST'])
def calculate():
    data = request.form['expression']
    result = eval(data)

    # Save the result to the database
    save_to_db(result)

    return render_template('index.html', result=result, expression=data)

def save_to_db(result):
    conn = sqlite3.connect('db/data.db')
    cursor = conn.cursor()
    cursor.execute('INSERT INTO calculations (result) VALUES (?)', (result,))
    conn.commit()
    conn.close()

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
