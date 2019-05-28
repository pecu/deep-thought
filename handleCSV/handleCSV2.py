import xlrd

workbook = xlrd.open_workbook('./textMining_ml.xlsx')

output = open('./textMining_ml.sql',"w",encoding = 'utf-8')
output.close()
output = open('./textMining_ml.sql',"a",encoding = 'utf-8')

#print(workbook.sheet_names())

output.write('use suspo; '+ '\n')

for i in range(2):
    if(i == 0):
        teachers = "石百達、蔡芸琤"
        assistants = "林毓祥"
        className = "金融科技-文字探勘與機器學習 (Fin 7067)"
        endRow = 6+73
    else:
        teachers = "蔡芸琤"
        assistants = "王冠人"
        className = "資料科學程式設計 (CSX 4001)"
        endRow = 6+45

    booksheet = workbook.sheet_by_index(i)
    
    for row in range(6,endRow):
        studentName = booksheet.cell_value(row,4)
        studentId = booksheet.cell_value(row,3)
        #studentPass = booksheet.cell_value(row,2)
        studentPass = "是"
        if(studentPass == "是"):
            output.write( "insert into Pass_List (className,studentName,studentId,teachers,assistants) values (" +  '\'' + className +  '\''+ "," +  '\''+ studentName +  '\''+ "," +  '\''+ studentId +  '\''+ "," +  '\''+ teachers +  '\''+ "," +  '\''+ assistants +  '\''+");" + '\n')
    
    teacherList = teachers.split('、')

    for teacher in teacherList:
        output.write('insert into Teach_List (teacherName,className) values (' +  '\'' + teacher + '\'' + "," + '\'' + className + '\'' + ");" + '\n')    

    assistantsList = assistants.split('、')

    for assistant in assistantsList:
        output.write('insert into Assist_List (assistantName,className) values (' +  '\'' + assistant + '\'' + "," + '\'' + className + '\'' + ");"  + '\n'  )




output.close()