.data
message: .asciiz "Gib einen Integer ein:"
ausgabe: .asciiz "Das Ergebnis ist: "
.text
main:
	li $v0, 51
	la $a0, message
	syscall
	
	move $t1, $a0
	
	li $v0, 51
	la $a0, message
	syscall
	
	move $t2, $a0
	
	li $v0, 51
	la $a0, message
	syscall
	
	move $t3, $a0
	
	li $v0, 51
	la $a0, message
	syscall
	
	move $t4, $a0;
	
	mult $t1, $t2 # mul kann drei benutzen 
	mflo $t5
	mult $t5, $t3
	mflo $t5
	mult $t5, $t4
	mflo $t5

	li $v0, 56
	la $a0, ausgabe
	move $a1, $t5
	syscall
	
	li $v0, 10
	syscall