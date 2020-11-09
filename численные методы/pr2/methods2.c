#include <stdio.h>
#include <stdlib.h>
#include <math.h>

float f (float x) { //функция
        return (x * x * x) + 2 * (x * x) - 8 * x + 3;
}

float df (float x) { //производная
        return (3 * x * x) + 4 * x - 8;
}		

int main()
{
        float eps, x, dx; //ввод точности, значения х и приращения
        int n; //итерации
        n = 0;

        eps = 0.001; //точность

        while(1) //проверка на точность
        {
                dx = f(x) / df(x);
                x = x - dx;
                if (fabs(dx) < eps) break; //если приращение будет меньше точности - возвращается последнее значение х + итерация
                n++;
                if (n >= 100) break; //при 100 итерациях цикл заканчивается
        }
        printf("OTBET: x = %f \n\nkol-vo iteracii: %d\n", x, n); //ответ

        return 0;
}
