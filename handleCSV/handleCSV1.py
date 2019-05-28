import xlrd

workbook = xlrd.open_workbook('./blockchain.xlsx')

output = open('./blockchain.sql',"w",encoding = 'utf-8')
output.close()
output = open('./blockchain.sql',"a",encoding = 'utf-8')

#print(workbook.sheet_names())

teachers = "蔡芸琤、陳彥奇"
assistants = "徐子修、司福民"

className = "進階軟體開發專題 (CSX 5001)"

output.write('use suspo;'+ '\n')

for i in range(1):
    booksheet = workbook.sheet_by_index(i)
    for row in range(1,27):
        studentName = booksheet.cell_value(row,0)
        studentId = booksheet.cell_value(row,1)
        studentPass = booksheet.cell_value(row,2)
        if(studentPass == "是"):
            output.write( "insert into Pass_List (className,studentName,studentId,teachers,assistants) values (" +  '\'' + className +  '\''+ "," +  '\''+ studentName +  '\''+ "," +  '\''+ studentId +  '\''+ "," +  '\''+ teachers +  '\''+ "," +  '\''+ assistants +  '\''+");"+ '\n')
    
teacherList = teachers.split('、')

for teacher in teacherList:
    output.write('insert into Teach_List (teacherName,className) values (' +  '\'' + teacher + '\'' + "," + '\'' + className + '\'' + ");"+ '\n')    

assistantsList = assistants.split('、')

for assistant in assistantsList:
    output.write('insert into Assist_List (assistantName,className) values (' +  '\'' + assistant + '\'' + "," + '\'' + className + '\'' + ");"   + '\n' )




output.close()