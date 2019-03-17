#!/usr/bin/env python3

from PIL import Image
import argparse
import sys

parser = argparse.ArgumentParser()
parser.add_argument('-f', '--file', help="file to convert", type=str)
parser.add_argument('-o', '--output', help="output file path (must be PNG)", type=str)
parser.add_argument('-s', '--same_folder_and_name', help="output file in the same folder with the same name", action="store_true", default=False)
args = parser.parse_args()

def JpgToPng(file_path, output_path):
    im = Image.open(file_path)
    im.save(output_path)

def main():
    try:
        if args.same_folder_and_name:
            file_path = "/".join(args.file.split("/")[:-1]) + "/"
            file_name = args.file.split("/")[-1].split(".")[0]
            output_path = file_path + file_name + ".PNG"
            JpgToPng(args.file, output_path)

        elif args.output:
            file_path = args.output
            if file_path[-4:] == ".PNG":
                output_path = file_path
                JpgToPng(args.file, output_path)
            else:
                output_path = file_path + ".PNG"
                JpgToPng(args.file, output_path)
        else:
            parser.print_help()

    except Exception as e:
        print("Error: " + str(e))

if __name__ == '__main__':
    main()
